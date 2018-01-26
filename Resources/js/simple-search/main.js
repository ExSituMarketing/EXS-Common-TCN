var SIMPLESEARCH = SIMPLESEARCH || {};

SIMPLESEARCH.main = {
    // fetches results from dataset (data.js)
    results: function(s) {
        var search = s.toLowerCase();
        var total = data.length;
        var result = [];
        var i, name;

        for (i = 0; i < total; i++) {
            if (result.length >= 10) {
                break;
            }
            name = data[i].name.toLowerCase();

            if (name.indexOf(search) != -1) {
                result.push(data[i]);
            }
        }

        return result;
    },

    // creates list of DOM for the results
    returnResults: function(d) {
        while (list.hasChildNodes()) {
            list.removeChild(list.lastChild);
        }

        if (d.length > 0) {
            var results = d.length;
            var i;

            list.style.listStyle = "none";
            list.style.paddingLeft = "12px";
            list.style.backgroundColor = "#fff";
            list.style.width = "227px";

            for (i = 0; i < results; i++) {
                var item = document.createElement('li');
                var itemText = document.createElement('a');
                var tourlink = "/out/" + d[i].slug;

                itemText.textContent = d[i].name;
                itemText.setAttribute('href', tourlink);
                itemText.setAttribute('data-site-name', d[i].name);
                itemText.setAttribute('target', '_blank');

                item.appendChild(itemText);

                item.addEventListener('click', function() {
                    search.value = '';
                    searchTerm = '';
                    sBtn.className = 'btn btn-default';
                    sBtn.children[0].className = "glyphicon glyphicon-search";
                    while (list.hasChildNodes()) {
                        list.removeChild(list.lastChild);
                    }
                });

                list.appendChild(item);

                if (list.parentNode.querySelector('p')) {
                    list.parentNode.querySelector('p').remove();
                }
            }
        }
    },

    // creates a message to show no results
    noResults: function(_m) {
        if (!_m) {
            return;
        }

        var itemText = document.createElement("p");

        itemText.innerHTML += _m;
        itemText.style.color = "#2b2b2b";
        itemText.style.padding = "5px 30px 5px 12px";
        itemText.style.backgroundColor = "#fff";
        itemText.style.width = "227px";

        if (search.parentNode.querySelector('p')) {
            search.parentNode.removeChild(search.parentNode.querySelector('p'));
        }

        search.parentNode.appendChild(itemText);
    }
};
