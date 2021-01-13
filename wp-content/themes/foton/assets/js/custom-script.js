document.addEventListener("DOMContentLoaded", function (event) {
    var signTabs = document.querySelectorAll('.sign-block'),
        signLinks = document.querySelectorAll('.sign-link');

    signLinks.forEach(function (tabLink) {
        tabLink.addEventListener('click', function () {
            var linkName = this.getAttribute('data-link');
            signLinks.forEach(function (elem) {
                elem.classList.remove('active');
            });
            this.classList.add('active');
            signTabs.forEach(function (tab) {
                tab.classList.remove('sign-active');
                if (tab.getAttribute('data-name') === linkName) {
                    tab.classList.add('sign-active');
                }
            });
        })
    })


    if (window.location.pathname == '/') {
        let videoBtn = document.getElementById('play-video_btn'),
            videoPopup = document.getElementById('prew-video'),
            videoCloseBg = document.getElementById('close-bg'),
            videoCloseBtn = document.getElementById('close-btn');

        videoBtn.addEventListener('click', function () {
            videoPopup.style.display = 'flex';
        });

        videoCloseBg.addEventListener('click', function () {
            videoPopup.style.display = 'none';
        });

        videoCloseBtn.addEventListener('click', function () {
            videoPopup.style.display = 'none';
        });
    }
});