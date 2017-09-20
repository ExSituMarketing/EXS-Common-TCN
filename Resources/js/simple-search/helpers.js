/**
 * Helper functions taken from kraken
 * Determines local vs external domain
 * Namespaced by MYFAV to avoid collisions
 */
var MYFAV = MYFAV || {};

MYFAV.helpers = {
    /* normalize url function */
    checkDomain: function (url) {
        if (url.indexOf('//') === 0) {
            url = location.protocol + url;
        }
        return url.toLowerCase().replace(/([a-z])?:\/\//, '$1').split('/')[0];
    },
    /* check for the external link */
    isExternal: function (url) {
        return ((url.indexOf(':') > -1 || url.indexOf('//') > -1) && this.checkDomain(location.href) !== this.checkDomain(url));
    }
};
