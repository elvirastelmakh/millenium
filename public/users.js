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

        var tab = elem.appendChild(document.createElement('table'));
        var tr = tab.appendChild(document.createElement('tr'));
        var th_full_name = tr.appendChild(document.createElement('th'));
        th_full_name.innerText = 'Full Name';
        var th_birthday = tr.appendChild(document.createElement('th'));
        th_birthday.innerText = 'Birthday';
        var users = response;
        if (users.length == 0){
            return;
        }
        users.forEach(function(user) {
            tr = tab.appendChild(document.createElement('tr'));
            var tr_full_name = tr.appendChild(document.createElement('td'));
            var a_id = tr_full_name.appendChild(document.createElement('a'));
            a_id.href = '/user.html?id='+user.id;
            a_id.innerText = user.full_name;
            var tr_birthday = tr.appendChild(document.createElement('td'));
            tr_birthday.innerText = user.birthday;
            tr_birthday.className = 'center';
        });
    };

    xhr.open('GET', '/users.php');
    xhr.send();
}
