/**
 * JS for searching merchant listings
 * DCobb
 *
 * Implements HTML templates:
 *  - /public_html/templates/merchantCard.tpl.php >> creates the result cards
 *  - /public_html/templates/merchantDetails.tpl.php >> creates the view details overlay
 *
 * This JS creates/fills the templates with the needed information
 *
 * !!! Production uses the minified file !!!
 *  - /public_html/public/js/searchMerchants.min.js
 *
 */

// URLS for AJAX calls:
const getMerchantInfoURL = '/wsc-plugin/ajax/getMerchantInfo.php?id=',
    searchMerchantsURL = '/wsc-plugin/ajax/publicMerchantSearch.php',
    searchBtn = document.getElementById('searchMerchants'),
    close = document.querySelector('.close-modal'),
    overlay = document.querySelector('.wsc-overlay'),
    // Event functions
    closeEvent = function (e) {
        overlay.classList.remove('view-modal');
        document.getElementById('merchant-details-wrapper').innerText = '';
    },
    showSponsor = function (e) {
        overlay.querySelector('.sponsor-info').classList.add('showSponsor');
    },
    hideSponsor = function (e) {
        overlay.querySelector('.sponsor-info').classList.remove('showSponsor');
    },
    // Event listeners to add after we have completed building our cards

    completeCards = () => {
        const details = document.querySelectorAll('.view-details'),
            overlay = document.querySelector('.wsc-overlay');

        details.forEach(item => {
            item.addEventListener('click', e => {
                addMerchantDetails(e.target.getAttribute('data-mid'));
                overlay.classList.toggle('view-modal');
                addLoader();
            });
        });
    },

    addLoader = function () {
        const modal = document.querySelector('.modal'),
            loader = document.createElement('div');

        loader.setAttribute('class', 'loader');
        modal.appendChild(loader);
    },
    removeLoader = function () {
        const loader = document.querySelector('.loader');

        document.querySelector('.modal').removeChild(loader);
    };

close.removeEventListener('click', closeEvent);
const initMap = function (markersin, close = false) {
    //// The location of Uluru
    //var uluru = { lat: -25.344, lng: 131.036 };
    //// The map, centered at Uluru
    let map = new google.maps.Map(document.getElementById('map'), {
            zoom : 18,
        }),
        //// The marker, positioned at Uluru
        //var marker = new google.maps.Marker({ position: uluru, map: map });

        bounds = new google.maps.LatLngBounds(),

	 markers = markersin;

    //    [
    //['London Eye, London', 51.503454, -0.119562],
    //['Palace of Westminster, London', 51.499633, -0.124755]
    //];
    for (i = 0; i < markers.length; i ++) {
        let position = new google.maps.LatLng(markers[i].lat, markers[i].long);

        bounds.extend(position);
        marker = new google.maps.Marker({
            position : position,
            map      : map,
            title    : markers[i].name,
        });
        if (markers.length > 1) {
            map.fitBounds(bounds);
        } else {
            map.setCenter(position);
        }
    }

    if (! close) {
        $('#map').show();
    } else {
        $('#map').hide();
    }
};

function showTable() {
    $('.viewTable').DataTable({

        'iDisplayLength' : 25,
    });

    $('.viewTable').show();
    $('#Loading').hide();
}
// Add the template to the modal on click
function addMerchantDetails(id) {
    fetch(getMerchantInfoURL + id).then(res => {
        return res.json();
    }).then(data => {
        close.removeEventListener('click', closeEvent);
        close.addEventListener('click', closeEvent);
        const r = data.data[0],
            sD = data.sponsor[0];
        let address = '';

        (r.street_number != null && r.street != null) ? address = `${r.street_number} ${r.street} `: null;
        r.city != null ? address += `${r.city}, ` : null;
        r.state != null ? address += `${r.state}, ` : null;
        r.zip != null ? address += `${r.zip}, ` : null;
        r.country != null ? address += `${r.country}` : null;
        r.storefront_image == null ? r.storefront_image = 'default.jpg' : null;
        r.user_image == null ? r.user_image = 'default.svg' : null;
        r.business_phone.length <= 0 ? r.business_phone = r.phone : null;
        if (r.video != null && r.video.indexOf('https://www.youtube.com/embed/') == - 1) {
            if (r.video != null) {
                let video = r.video.split('watch?v=');

                r.video = `https://www.youtube.com/embed/${video[1]}`;
            }
        }
        const modalTemp = document.getElementById('merchant-details-wrapper'),
            template = document.getElementById('merchant-full-details-template'),
            details = document.importNode(template.content, true);

        details.querySelector('.merch-name').innerText = (r.name.length > 0 ? r.name : 'Not Provided');
        details.querySelector('.merch-address').innerText = address;
        details.querySelector('.phone').innerText = (r.business_phone.length > 0 ? r.business_phone : 'Not Provided');
        if (r.business_phone.length > 0) {
            details.querySelector('.phone').setAttribute('href', `tel:+${encodeURIComponent(r.business_phone)}`);
        }
        details.querySelector('.email').innerText = (r.business_email.length > 0 ? r.business_email : 'Not Provided');
        if (r.business_email.length > 0) {
            details.querySelector('.email').setAttribute('href', `mailto:${encodeURIComponent(r.business_email)}`);
        }
        details.querySelector('.web').innerText = (r.facebook != undefined ? r.facebook : 'Not Provided');
        details.querySelector('.facebook-link').innerText = (r.facebook != undefined ? r.facebook : 'Not Provided');
        if (r.facebook != undefined) {
            details.querySelector('.web').setAttribute('href', encodeURI(r.facebook));
            details.querySelector('.facebook-link').setAttribute('href', encodeURI(r.facebook));
            details.querySelector('.facebook-social').setAttribute('href', encodeURI(r.facebook));
        } else {
            details.querySelector('.web').innerText = 'Not Provided';
            details.querySelector('.facebook-link').innerText = 'Not Provided';
            details.querySelector('.facebook-social').style.display = 'none';
        }
        details.querySelector('.participation').innerText = (r.participation_level.length > 0 ? r.participation_level : 'Not Provided');
        details.querySelector('.merch-category').innerText = (r.service_category.length > 0 ? r.service_category : 'Not Provided');
        details.querySelector('.store-image').setAttribute('src', `/portal/merchant_photos/${r.storefront_image}`);
        details.querySelector('.store-image-m').setAttribute('src', `/portal/merchant_photos/${r.storefront_image}`);
        if (r.video != null && r.video.length > 0) {
            details.querySelector('.video-m').setAttribute('href', encodeURI(r.video));
            details.querySelector('.video-full').setAttribute('src', encodeURI(r.video));
        } else {
            details.querySelector('.video-m').style.display = 'none';
            details.querySelector('.video-full').style.display = 'none';
        }
        // If we're not in the portal hide the sponsor button
        if (! (window.location.href.indexOf('portal/merchant_locations') > - 1)) {
            const sponsor = details.querySelectorAll('.view-sponsor');

            sponsor.forEach(s => {
                s.style.display = 'none';
            });
            details.querySelector('.email').style.display = 'none';
            details.querySelector('.web').style.display = 'none';
            details.querySelector('.facebook-link').style.display = 'none';
            details.querySelector('.facebook-social').style.display = 'none';
            details.querySelector('.user-image').style.display = 'none';
            details.querySelector('.video-m').style.display = 'none';
            details.querySelector('.video-full').style.display = 'none';
            details.querySelectorAll('.public').forEach(p => {
                p.style.display = 'none';
            });
            document.querySelector('.modal').classList.add('public-modal');
        } else {
            details.querySelector('.user-image').setAttribute('src', `/portal/user_images/${encodeURI(r.user_image)}`);
            sD.full_name == null ? sD.full_name = '' : null;
            sD.email == null ? sD.email = '' : null;
            sD.mobile == null ? sD.mobile = '' : null;
            sD.facebook_link == null ? sD.facebook_link = '' : null;
            details.querySelector('.s-name').innerText = (sD.full_name.length > 0 ? sD.full_name : 'Not Provided');
            details.querySelector('.s-email').innerText = (sD.email.length > 0 ? sD.email : 'Not Provided');
            if (sD.email.length > 0) {
                details.querySelector('.s-email').setAttribute('href', encodeURIComponent(`mailto:${sD.email}`));
            }
            details.querySelector('.s-phone').innerText = (sD.mobile.length > 0 ? sD.mobile : 'Not Provided');
            if (sD.mobile.length > 0) {
                details.querySelector('.phone').setAttribute('href', `tel:+${encodeURIComponent(sD.mobile)}`);
            }
            details.querySelector('.s-facebook').innerText = (sD.facebook_link.length > 0 ? sD.facebook_link : 'Not Provided');
            if (sD.facebook_link.length > 0) {
                details.querySelector('.s-facebook').setAttribute('href', encodeURI(sD.facebook_link));
            }
            const hBtn = details.querySelectorAll('.hide-sponsor'),
                sBtn = details.querySelectorAll('.view-sponsor');

            hBtn.forEach(b => {
                b.removeEventListener('click', hideSponsor);
                b.addEventListener('click', hideSponsor);
            });
            sBtn.forEach(b => {
                b.removeEventListener('click', showSponsor);
                b.addEventListener('click', showSponsor);
            });
        }
        modalTemp.appendChild(details);

        return true;
    }).then(() => {
        removeLoader();
    });
}
class BuildResults
{
    constructor() {
        this.res = null;
        this.page = 1;
        this.results = 50;
        this.loaded = true;
        this.loadMore = this.loadPage.bind(this);
    }
    setResults(data) {
        this.res = data;
        this.page = 1;
        this.results = 50;
    }
    addResults() {
        document.removeEventListener('scroll', this.loadMore);
        window.removeEventListener('resize', this.loadMore);
        window.removeEventListener('orientationChange', this.loadMore);
        this.loaded = false;
        const template = document.getElementById('merchant-search-template'),
            results = document.querySelector('.results-wrapper'),
            overlay = document.querySelector('.wsc-overlay');

        let currentCard = 1,
            offset = this.page * this.results,
            start = this.page * this.results;

        Object.keys(this.res).forEach(k => {
            if (k <= offset && k > start - this.results) {
                let r = this.res[k],
                    address = '';

                (r.street_number != null && r.street != null) ? address = `${r.street_number} ${r.street} `: null;
                r.city != null ? address += `${r.city}, ` : null;
                r.state != null ? address += `${r.state}, ` : null;
                r.zip != null ? address += `${r.zip}, ` : null;
                r.country != null ? address += `${r.country}` : null;
                r.storefront_image == null ? r.storefront_image = 'default.jpg' : null;
                const card = document.importNode(template.content, true);

                card.querySelector('.card-name').innerText = r.name;
                card.querySelector('.card-address').innerText = address;
                card.querySelector('.card-type').innerText = r.service_category;
                card.querySelector('.card-participation').innerText = `Participation: ${r.participation_level}`;
                card.querySelector('.view-details').setAttribute('data-mid', r.merchant_listing_id);
                card.querySelector('.view-details').addEventListener('click', e => {
                    addMerchantDetails(e.target.getAttribute('data-mid'));
                    overlay.classList.toggle('view-modal');
                    addLoader();
                });
                if (currentCard < 10) {
                    card.querySelector('.card-image').setAttribute('src', `/portal/merchant_photos/${encodeURIComponent(r.storefront_image)}`);
                } else {
                    card.querySelector('.card-image').setAttribute('data-src', `/portal/merchant_photos/${encodeURIComponent(r.storefront_image)}`);
                    card.querySelector('.card-image').classList.add('lazy-img');
                }
                results.appendChild(card);
                currentCard ++;
            }
        });
        this.page = this.page + 1;
        setTimeout(function(){
            this.loaded = true;
        }.bind(this), 2000);
        this.watchForNewPage();
    }
    loadPage() {
        const elem = document.querySelector('.results-wrapper');

        let elemOffset = elem.offsetTop + elem.clientHeight,
            pageOffset = window.pageYOffset + window.innerHeight;

        if(pageOffset > elemOffset - 200) {
            if (this.loaded === true) {
                this.addResults();
            }
        }
    }
    watchForNewPage() {
        document.addEventListener('scroll', this.loadMore);
        window.addEventListener('resize', this.loadMore);
        window.addEventListener('orientationChange', this.loadMore);
    }
    run() {
        const template = document.getElementById('merchant-search-template'),
            results = document.querySelector('.results-wrapper');

        results.innerText = '';
        const mapDiv = document.createElement('div');

        mapDiv.setAttribute('id', 'map');
        results.appendChild(mapDiv);
        let currentCard = 1;

        if (this.res.length > 0) {
            Object.keys(this.res).forEach(k => {
                if (k <= this.page * this.results) {
                    let r = this.res[k],
                        address = '';

                    (r.street_number != null && r.street != null) ? address = `${r.street_number} ${r.street} `: null;
                    r.city != null ? address += `${r.city}, ` : null;
                    r.state != null ? address += `${r.state}, ` : null;
                    r.zip != null ? address += `${r.zip}, ` : null;
                    r.country != null ? address += `${r.country}` : null;
                    r.storefront_image == null ? r.storefront_image = 'default.jpg' : null;
                    const card = document.importNode(template.content, true);

                    card.querySelector('.card-name').innerText = r.name;
                    card.querySelector('.card-address').innerText = address;
                    card.querySelector('.card-type').innerText = r.service_category;
                    card.querySelector('.card-participation').innerText = `Participation: ${r.participation_level}`;
                    card.querySelector('.view-details').setAttribute('data-mid', r.merchant_listing_id);
                    if (currentCard < 10) {
                        card.querySelector('.card-image').setAttribute('src', `/portal/merchant_photos/${encodeURIComponent(r.storefront_image)}`);
                    } else {
                        card.querySelector('.card-image').setAttribute('data-src', `/portal/merchant_photos/${encodeURIComponent(r.storefront_image)}`);
                        card.querySelector('.card-image').classList.add('lazy-img');
                    }
                    results.appendChild(card);
                    currentCard ++;
                }
            });
            this.page = this.page + 1;
        } else {
            const template = document.getElementById('merchant-search-no-results'),
                card = document.importNode(template.content, true),
                img = document.createElement('img');

            img.setAttribute('src', '/wsc-plugin/plugin/merchantlocations/images/spendmerch.gif');
            results.appendChild(img);
        }
        this.watchForNewPage();
    }
}
const builder = new BuildResults();

searchBtn.addEventListener('click', e => {

    e.preventDefault();
    const form = document.getElementById('merchantSearchForm');
    let data = {};

    for (let i = 0; i < form.elements.length; i ++) {
        if (form.elements[i].type == 'checkbox') {
            data[form.elements[i].name] = form.elements[i].checked;
        } else {
            data[form.elements[i].name] = form.elements[i].value;
        }
    }
    data.action = form.getAttribute('data-action');
    data.fullview = 'n';
    $.ajax({
        type : 'POST',
        url  : searchMerchantsURL,
        self : this,
        data : {
            address             : data.address,
            city                : data.city,
            state               : data.state,
            country             : data.country,
            participation_level : data.participation_level,
            name                : data.merchant_name,
        },
        success : function (data) {
            let d = data.response;
            const results = document.querySelector('.results-wrapper');

            results.innerText = '';
            if (d.data.error) {
                document.getElementById('formAlert').textContent = d.data.error;
                document.getElementById('formAlert').style.display = 'block';
                if (document.querySelector('.no-results')) {
                    document.querySelector('.no-results').style.display = 'block';
                } else {
                    const template = document.getElementById('merchant-search-no-results'),
                        card = document.importNode(template.content, true),
                        img = document.createElement('img');

                    img.setAttribute('src', '/wsc-plugin/plugin/merchantlocations/images/spendmerch.gif');
                    results.appendChild(img);
                }
            } else {
                const mapDiv = document.createElement('div');

                mapDiv.setAttribute('id', 'map');
                results.appendChild(mapDiv);
                if (document.querySelector('.no-results')) {
                    document.querySelector('.no-results').style.display = 'none';
                }
                if (d.data.length > 0) {
                    document.getElementById('formAlert').style.display = 'none';
                    document.getElementById('formAlert').textContent = '';
                    let res = d.data;
                    // Uses the HTML template from merchant_locations.php
                    const template = document.getElementById('merchant-search-template');
                    let markers = [];

                    res.forEach(r => {
                        let address = '';

                        (r.street_number != null && r.street != null) ? address = `${r.street_number} ${r.street} `: null;
                        r.city != null ? address += `${r.city}, ` : null;
                        r.state != null ? address += `${r.state}, ` : null;
                        r.zip != null ? address += `${r.zip}, ` : null;
                        r.country != null ? address += `${r.country}` : null;
                        markers.push({
                            name    : r.name,
                            address : address,
                            lat     : r.latitude,
                            long    : r.longitude,
                        });
                    });
                    builder.setResults(d.data);
                    builder.run();
                    if (screen.width < 850) {
                        document.querySelector('#searchMerchants').scrollIntoView();
                    }
                    initMap(markers);
                    completeCards();
                } else {
                    const template = document.getElementById('merchant-search-no-results'),
                        card = document.importNode(template.content, true),
                        img = document.createElement('img');

                    img.setAttribute('src', '/wsc-plugin/plugin/merchantlocations/images/spendmerch.gif');
                    results.appendChild(img);
                    initMap([], true);
                }
            }
        },
        error : function (r) {
            //console.error(r)
        },
    });
});
(() => {
	const lazyLoad = function() {
	    const images = document.querySelectorAll('.lazy-img');

	    images.forEach(img => {
	        const top = img.offsetTop;

	        if (top <= window.pageYOffset + window.innerHeight + 2000 && top > window.pageYOffset + 500) {

	            if (img.getAttribute('data-src')) {
	                let src = img.getAttribute('data-src');

	                img.classList.remove('lazy-img');
	                img.setAttribute('src', src);
		   }
	        }
	        if (images.length == 0) {
	            document.removeEventListener('scroll', lazyLoad);
	            window.removeEventListener('resize', lazyLoad);
	            window.removeEventListener('orientationChange', lazyLoad);
	        }
	    });
	};

	document.addEventListener('scroll', lazyLoad);
	window.addEventListener('resize', lazyLoad);
	window.addEventListener('orientationChange', lazyLoad);
})();