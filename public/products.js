function init_app()
{
    var elem = document.getElementById('app');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if (xhr.readyState !== 4){
            return;
        };
        var response = JSON.parse(xhr.responseText);

        var tab = elem.appendChild(document.createElement('table'));
        var tr = tab.appendChild(document.createElement('tr'));
        tr.appendChild(document.createElement('th')).innerText = 'Product';
        tr.appendChild(document.createElement('th')).innerText = 'Price';

        var products = response;
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

    var form = document.getElementById("addProduct");
    form.onsubmit = addProduct;
    xhr.open('GET', '/product.php');
    xhr.send();
}

function addProduct(e){
    e.preventDefault();
    var form = new FormData(document.forms.addProduct);
    var xhr = new XMLHttpRequest();
    var title = form.get('title');
    cleanTitle = title.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    var json = JSON.stringify({
        title: cleanTitle,
        price:  form.get('price')
    });

    xhr.open("POST", '/product.php', true)
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhr.send(json);
    // Перезагрузить текущую страницу после добавления товара.
    location.href = "products.html"; 
    return false;
}
 
