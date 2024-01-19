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
async function addToFavorite(str) {
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