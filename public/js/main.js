
var newonew = document.getElementsByClassName('table-striped');

if(newonew.length == 1){
    var idElement = newonew[0].id;
    var list  = document.getElementById(idElement);
    list.addEventListener('click',e => {
        if(e.target.className === 'btn btn-danger delete-task'){
            if(confirm('Are you sure nead delete?')){
                const id = e.target.getAttribute('data-id');
                fetch(`/${idElement}/delete/${id}`,{
                    method: 'DELETE'
                }).then(res => window/location.reload());
            }
        }
    });
}





