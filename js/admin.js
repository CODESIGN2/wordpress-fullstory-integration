(function() {
    /*
    * Helper to extract FullStory Org code from URL
    */
    const SCHEME_INDICATOR = '://';
    const URL_PATH_SEPARATOR = '/';
    const FULLSTORY_DOMAIN_INDICATOR = 'app.fullstory.com';
    
    document.querySelector('#fullstory_org_code').addEventListener('input', function(event) {
        const curInput = event.target;
        const curValue = curInput.value;
        if (curValue.includes(SCHEME_INDICATOR) && curValue.includes(FULLSTORY_DOMAIN_INDICATOR)) {
            const urlParts = curValue.split(URL_PATH_SEPARATOR);
            curInput.value = urlParts.length > 5 ? urlParts[4] : curValue;
        }
    });
})();