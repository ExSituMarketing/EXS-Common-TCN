/*** Simple Search Script ***/
var search = document.querySelector('.search');

if (search) {
    var sBtn = search.parentNode.querySelector('button');
    var list = document.createElement('ul');
    var searchTerm, resultData;

    search.appendChild(list);
    search = search.querySelector('input');

    // keyboard event logic
    search.addEventListener('keyup', function (e) {
        searchTerm = this.value;
        resultData = [];

        if (this.parentNode.querySelector('p')) {
            this.parentNode.removeChild(search.parentNode.querySelector('p'));
        }

        if (searchTerm.length > 2 && searchTerm.length != 0) {
            resultData = SIMPLESEARCH.main.results(searchTerm);
        }

        // enter/return key
        if (e.keyCode == 13) {
            if (list.children.length == 0 && searchTerm.length < 3) {
                SIMPLESEARCH.main.noResults("Enter 3 or more chars")
            } else {
                window.location = "/search.php?q=" + searchTerm;
            }
        }

        if (resultData.length > 0) {
            this.nextElementSibling.children[0].className = "glyphicon glyphicon-remove"
        } else {
            this.nextElementSibling.children[0].className = "glyphicon glyphicon-search"
        }

        SIMPLESEARCH.main.returnResults(resultData);
    });

    // button click event logic
    sBtn.addEventListener('click', function () {
        if (list.children.length == 0) {
            if (!searchTerm) {
                SIMPLESEARCH.main.noResults('Enter 3 or more chars');
            } else {
                if (searchTerm.length < 3) {
                    SIMPLESEARCH.main.noResults('Enter 3 or more chars');
                } else if (searchTerm.length > 2) {
                    SIMPLESEARCH.main.noResults('No results found');
                }
            }
        } else if (this.children[0].className == 'glyphicon glyphicon-remove') {
            search.value = '';
            searchTerm = '';
            this.children[0].className = 'glyphicon glyphicon-search';
            if (list.parentNode.querySelector('p')) {
                list.parentNode.querySelector('p').remove();
            }
            while (list.hasChildNodes()) {
                list.removeChild(list.lastChild);
            }
        } else {
            window.location = "/search.php?q=" + searchTerm;
        }
    });
}
