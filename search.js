// Send search request to PHP script
function searchVoters() {
    var searchQuery = document.getElementById('search').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'search.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('search=' + searchQuery);

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('search-results').innerHTML = xhr.responseText;
        }
    };
}

