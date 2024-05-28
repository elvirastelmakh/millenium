function init_app()
{
    var elem = document.getElementById('app');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (xhr.readyState !== 4){
            return;
        };
        var response = JSON.parse(xhr.responseText);

        if (typeof response !== 'object'){
            return;
        }
        //elem.appendChild(document.createTextNode(response.user));
        var div_user = elem.appendChild(document.createElement('div'));
        div_user.innerText = response.user;
        div_user.className = 'center';
        div_user.style.width = '600px';
        div_user.style.fontWeight= 'bold';

        var tab = elem.appendChild(document.createElement('table'));
        var tr = tab.appendChild(document.createElement('tr'));
        tr.appendChild(document.createElement('th')).innerText = 'Ordered product';
        tr.appendChild(document.createElement('th')).innerText = 'Price';

        var products = response.order;
        if (products.length == 0){
            return;
        }
        products.forEach(function(product) {
            tr = tab.appendChild(document.createElement('tr'));
            tr.appendChild(document.createElement('td')).innerText = product.title;
            var td_price = tr.appendChild(document.createElement('td'));
            td_price.innerText = product.price;
            td_price.className = 'center';
        });
    };

    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');
    xhr.open('GET', '/user.php?id='+id);
    xhr.send();
}
