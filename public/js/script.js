async function userExists(str) {
    try {
        let message = document.getElementById('message');
        message.className= "message";
        message.innerHTML = "";
        let response = await fetch(
            "http://localhost?c=users&a=getUser&user="+str,
            {
                method: "GET",
                headers: {
                    "Content-type": "application/json",
                    "Accept" : "application/json",
                }
            });
        if (response.status !== 200 ) alert("error");
        if (response.status === 204)  alert("");
        let respon = await response.json();
        if(!respon){
            message.innerHTML ="User name already exists";
            message.className= "alert alert-danger";
        }
    } catch(ex) {
        alert(ex);
    }
}
async function pictureExists(picture = null, id=null) {
    try {
        let message = document.getElementById('message');
        message.className= "message";
        message.innerHTML = "";
        let response = await fetch(
            "http://localhost/?c=ideas&a=getPicture&picture="+picture+"&id="+id,
            {
                method: "GET",
                headers: {
                    "Content-type": "application/json",
                    "Accept" : "application/json",
                }
            });
        if (response.status !== 200 ) alert("error");
        if (response.status === 204)  alert("not found");
        let respon = await response.json();
        if(!respon){
            message.innerHTML ="Same picture already exists in ideas, are you sure you want this one?";
            message.className= "alert alert-info";
        }
    } catch(ex) {
        alert(ex);
    }
}
async function titleExists(title = null,id=null) {
    try {
        let message = document.getElementById('message2');
        message.className= "message2";
        message.innerHTML = "";
        let response = await fetch(
            "http://localhost/?c=ideas&a=getTitle&title="+title+"&id="+id,
            {
                method: "GET",
                headers: {
                    "Content-type": "application/json",
                    "Accept" : "application/json",
                }
            });
        if (response.status !== 200 ) alert("error");
        if (response.status === 204)  alert("not found");
        let respon = await response.json();
        if(!respon){
            message.innerHTML ="Same Title already exists in ideas, are you sure you want this one?";
            message.className= "alert alert-info";
        }
    } catch(ex) {
        alert(ex);
    }
}
