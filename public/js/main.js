const tasks = document.getElementBy('123');

if(tasks){
    tasks.addEventListener('click',e => {
     if(e.target.className === 'btn btn-danger delete-tesk'){
       if(confirm('Are you sure nead delete?')){
           const id = e.target.getAttribute('data-id');
      fetch(`/zp/delete/${id}`,{
          method: 'DELETE'
      }).then(res => window/location.reload());
       }
     }
    });
}