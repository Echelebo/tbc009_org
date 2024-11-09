import htm from 'https://unpkg.com/htm?module'; // https://github.com/developit/htm

const html = htm.bind(React.createElement);

export {
    html
};

export class PublicChat extends React.Component {
    constructor(props) {
        super(props);
        if (document.cookie) {
            // If we decided to allow the chat on more than just login page, this is were we would restore that session...
            const session = null;

            document.cookie = 't=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';

            let data = session != null ? JSON.parse(session) : null;

            this.state = data || {user : null, thread : null,assigned : false, scrolled : false, closedChat : false,};
        } else {
            this.state = {
                user       : null,
                thread     : null,
                assigned   : false,
                scrolled   : false,
                closedChat : false,
            };
        }
        this.statusFunc = this.checkStatus.bind(this);
    }
    setCookie(data) {
        document.cookie = `t=${data}`;
    }
    getCookie(cname) {
        let name = cname + '=',
            decodedCookie = decodeURIComponent(document.cookie),
            ca = decodedCookie.split(';');

        for(let i = 0; i <ca.length; i ++) {
            let c = ca[i];

            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }

        return null;
    }
    watchActive(user) {
        setInterval(() => {
            if(! this.state.closedChat) {
                const data = JSON.stringify({user : user, status : 'online',});

                fetch('/wsc-plugin/ajax/public/online.php?', {
                    method  : 'POST',
                    body    : data,
                    headers : {
                        'Content-Type' : 'application/json',
                    },
                });
            }
        }, 10000);
    }
    openChat(e) {
        e.preventDefault();
        const chat = document.querySelector('.wsc_support-button');

        document.querySelector('.wsc_support-chat').classList.toggle('show');
        if (document.querySelector('.wsc_support-chat').classList.contains('show')) {
            chat.innerText = 'Minimize Chat';
        } else {
            chat.innerText = 'Chat With Support';
        }
    }

    initChat(e) {
        e.preventDefault();
        const tempUser = `000${Math.round(Math.random() * 100000000)}`,
            chatThread = `stid_${Math.round(Math.random() * 100000000)}`,
            email = document.querySelector('#email').value,
            summary = document.querySelector('#summary').value,
            data = JSON.stringify({user : tempUser, thread : chatThread, email : email, summary : summary,});

        this.setCookie(data);
        fetch('/wsc-plugin/ajax/public/public.php', {
            method  : 'POST',
            body    : data,
            headers : {
                'Content-Type' : 'application/json',
            },
        });
        this.watchActive(tempUser);
        this.setState({
            user       : tempUser,
            thread     : chatThread,
            closedChat : false,
        });
    }
    getMessages(thread, user) {
        fetch(`/wsc-plugin/ajax/public/message-list.php`, {
            method  : 'POST',
            body    : JSON.stringify({t : thread, u : user,}),
            headers : {
                'Content-Type' : 'application/json',
            },
        }).then(res => {return res.json();}).then(res => {
            // check response and update this.assigned, update messages, assign admin values
            if (this.state.messages != null) {
                if(res == null) {
                    document.cookie = 't=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
                    this.setState({
                        messages   : res,
                        user       : null,
                        thread     : null,
                        assigned   : false,
                        scrolled   : false,
                        closedChat : true,
                    });
                } else {
                    this.setState({
                        messages   : res,
                        closedChat : false,
                    });
                }
            } else {
                this.setState({
                    messages   : res,
                    closedChat : false,
                });
            }
        });
    }
    checkAssign(thread, user) {
        if (thread != null && user != null) {
            fetch(`/wsc-plugin/ajax/public/get-assign.php`, {
                method  : 'POST',
                body    : JSON.stringify({t : thread, u : user,}),
                headers : {
                    'Content-Type' : 'application/json',
                },
            }).then(res => {return res.json();}).then(res => {
                // check response and update this.assigned, update messages, assign admin values
                const r = res.data[0];

                if (r != undefined && r.status == 'assigned') {
                    this.setState({
                        assigned : true,
                        admin_id : r.admin_id,
                    });
                } else {
                    if (res == null) {
                        document.cookie = 't=; expires=Thu, 01 Jan 1970 00:00:00 UTC;';
                        this.setState({
                            messages   : res,
                            user       : null,
                            thread     : null,
                            assigned   : false,
                            scrolled   : false,
                            closedChat : true,
                        });
                    }
                }

                return false;
            });
        }

        return false;
    }
    checkStatus(reset = false) {
        const user = this.state.user,
            thread = this.state.thread;

        // if the support queue entry is assigned then we need to update our message list
        if (! this.state.assigned) {
            this.checkAssign(thread, user);
        } else {
            this.getMessages(thread, user);
            if (reset) {
                this.setState({scrolled : false,});
            }
        }
    }
    buildMessageList() {
        if (this.state.messages == null || this.state.messages == undefined) {
            return html `
            <div class="message incoming">
                <div class="message-wrapper">
                    <div class="message-head"></div>
                    <div class="message-body">
                        A Support Team member will be with you shortly.
                    </div>
                </div>
            </div>
            `;
        } else {
            const m = this.state.messages;

            let out = [];

            Object.keys(m).forEach(i => {
                let obj = m[i],
                    blast,
                    msg = {};

                if (obj.system) {
                    blast = `<i class="fa fa-rocket blast-icon"></i>SYSTEM BLAST: `;
                } else {
                    blast = obj.blast ? `<i class="fa fa-rocket blast-icon"></i>BLAST: ` : ``;
                }

                msg.__html = blast + (obj.message.split('\n').map(item => {
                    return item + '<br />';
                }).join(''));
                let message = html `
                <div class="message ${obj.type}">
                    <div class="message-wrapper">
                        <div class="message-head">
                            ${obj.timestamp}
                        </div>
                        <div class="message-body" dangerouslySetInnerHTML=${msg}>
                        </div>
                    </div>
                </div>
            `;

                out.push(message);
            });

            return out;
        }
    }
    sendMessage(e) {
        e.preventDefault();
        const form = document.querySelector('#chatCompose');

        let message = form.querySelector('#compose').value,
            user = form.querySelector('#temp_user').value,
            thread = form.querySelector('#temp_thread').value,
            admin = document.querySelector('.incoming');

        const data = {
            for_user_id : this.state.admin_id,
            by_user_id  : user,
            message     : message,
            thread      : thread,
        };

        fetch(`/wsc-plugin/ajax/public/send.php`, {
            method  : 'POST',
            body    : JSON.stringify(data),
            headers : {
                'Content-Type' : 'application/json',
            },
        }).then(res => {return res.json();}).then(res => {
            form.querySelector('#compose').value = '';
            this.checkStatus(true);
        });
    }
    componentDidUpdate() {
        if (! this.state.scrolled && this.state.assigned && this.state.closedChat != true) {
            const ml = document.querySelector('#support-message');

            ml.scrollTop = ml.scrollHeight;
        }
    }
    componentDidMount() {
        setInterval(this.statusFunc, 3000);
    }
    render() {
        if (this.state.user && this.state.thread && this.state.closedChat != true) {
            return html `
        <div class="wsc_support-button" onClick='${this.openChat.bind(this)}'>
            Chat With Support
        </div>
        <div class="wsc_support-chat">
            <div id="support-message" onWheel="${() => {this.setState({scrolled : true,});}}">
                ${this.buildMessageList()}
            </div>
            <form action="#" id="chatCompose">
                <input type="hidden" id="temp_user" value="${this.state.user}"/>
                <input type="hidden" id="temp_thread" value="${this.state.thread}"/>
                <input type="text" name="compose" id="compose"/>
                <button id="wsc-openChat" onClick='${this.sendMessage.bind(this)}'><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
        `;
        } else {
            return html `
        <div class="wsc_support-button" onClick='${this.openChat.bind(this)}'>
            Chat With Support
        </div>
        <div class="wsc_support-chat">
            <form action="#" id="initChat">
                <label for="email">Please Enter Your Email</label>
                <input type="email" name="email" id="email"/>
                <label for="summary">How can we help you today?</label>
                <input type="text" name="summary" id="summary" required/>
                <input type="submit" value="Start Chat" onClick='${this.initChat.bind(this)}'/>
            </form>
        </div>
        `;
        }
    }
}

ReactDOM.render(React.createElement(PublicChat, {}, null), document.getElementById('wsc_support_chat'));