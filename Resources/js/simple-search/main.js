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
            list.style.position = "absolute";
            list.style.paddingLeft = "12px";
            list.style.backgroundColor = "#fff";
            list.style.width = "227px";

            for (i = 0; i < results; i++) {
                var item = document.createElement('li');
                var itemText = document.createElement('a');

                itemText.textContent = d[i].name;
                itemText.setAttribute('href', d[i].link);
                itemText.setAttribute('data-site-name', d[i].name);
                if (MYFAV.helpers.isExternal(d[i].link)) {
                    itemText.setAttribute('target', '_blank');
                }

                item.appendChild(itemText);

                item.addEventListener('click', function () {
                    search.value = this.querySelector('a').textContent;
                    sBtn.className = '';
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

    // Generates the content of the search page results
    generateContent: function(searchTerm) {
        var resultData = SIMPLESEARCH.main.results(searchTerm);
        var content = document.getElementById('searchResults');

        if (resultData.length > 0) {
            for (var i = 0; i < resultData.length; i++) {
                var row = document.createElement('tr');

                if (i % 2 == 0) {
                    row.className = "shaded-background";
                }

                var rank = document.createElement('td');
                rank.innerHTML = "#" + (i + 1);
                rank.className = "numbers";

                var siteTitle = document.createElement('td');
                var siteTitleLink = document.createElement('a');
                var siteTitleImg = document.createElement('img');
                var reviewSite = document.createElement('td');
                var reviewSiteLink = document.createElement('a');
                var visitSite = document.createElement('td');
                var visitSiteLink = document.createElement('a');

                siteTitle.className = "site";
                siteTitleLink.href = resultData[i].link;
                siteTitleImg.className = "img-responsive";
                siteTitleImg.src = "/images/" + resultData[i].page.toLowerCase() + ".png";
                siteTitleImg.alt = resultData[i].name;

                siteTitleLink.appendChild(siteTitleImg);
                siteTitle.appendChild(siteTitleLink);

                reviewSite.className = "text-center reviewlink";
                reviewSiteLink.href = resultData[i].link;
                reviewSiteLink.innerHTML = resultData[i].name + "<br />Review";

                reviewSite.appendChild(reviewSiteLink);

                visitSite.className = "text-center viewbutton";
                visitSiteLink.href = "/out/" + resultData[i].page.toLowerCase() + "/";
                visitSiteLink.text = "Visit " + resultData[i].name;
                visitSiteLink.className = "btn btn-info btntop10";
                visitSiteLink.setAttribute('target', '_blank');

                visitSite.appendChild(visitSiteLink);

                row.appendChild(rank);
                row.appendChild(siteTitle);
                row.appendChild(reviewSite);
                row.appendChild(visitSite);

                content.appendChild(row);
            }
        } else {
            var resultsTable = document.getElementById('search-results');
            resultsTable.style.display = 'none';

            var noResultsFound = document.getElementById('no-results-found');
            noResultsFound.style.display = 'block';
        }
        
        if(typeof KRAKEN != 'undefined') {
          var identityTrackingListner = function() { 
              if(this.href != 'undefined' && this.href.toLowerCase().indexOf("out/") > -1) {
                  KRAKEN.common.trackingIdentity(); 
              }
          }   
          KRAKEN.common.addIdentityTrackingListner(identityTrackingListner);
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
        itemText.style.position = "absolute";
        itemText.style.padding = "5px 30px 5px 12px";
        itemText.style.backgroundColor = "#fff";

        if (search.parentNode.querySelector('p')) {
            search.parentNode.removeChild(search.parentNode.querySelector('p'));
        }

        search.parentNode.appendChild(itemText);
    }
};