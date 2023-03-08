
export const RedirectChoice = (to, from, next) => {
  
  console.log("autorisation1"+to.meta.permission);
  if (to.meta.permission) {
    document.permission = to.meta.permission(to);
  }

  //let temp = new RegExp("\b/UserBoard");

  //console.log("autorisation"+document.permission);
  switch(document.permission){

    case 'user':
      /*
      let autho = "user";
      localStorage.setItem('permission',JSON.stringify(autho));*/
      //console.log("permi"+localStorage.getItem('permission'));
      //console.log("route"+to.path);
      if(to.meta.rights){
        document.rights = to.meta.rights(to);
        let bool = false;
        let temp4 = document.rights;
        for(let i = 0; i < temp4.length; i++){
          if(to.params.id == temp4[i]){
            bool = true;
            break;
          }
        }
        if(bool){
          var comp = to.path;
          const test = comp.match(/UserBoard/i);
          console.log(test);
          
          if(test == null || test[0] !== 'UserBoard')
          {
            next({name: 'Nonauthorised'});
          }else{
            if(to.meta.auth){
              next();
            }else{
              next({name: 'Nonauthorised'});
            }
          } 
        }else{
          next({name: 'Nonauthorised'}); 
        }  
      }else{
        var comp = to.path;
        const test = comp.match(/UserBoard/i);
        console.log(test);
          
        if(test == null || test[0] !== 'UserBoard')
        {
          next({name: 'Nonauthorised'});
        }else{
          if(to.meta.auth){
            next();
          }else{
            next({name: 'Nonauthorised'});
          }
        }
      }
      break;

    case 'admin':
      var comp1 = to.path;
      const test1 = comp1.match(/AdminBoard/i);
      console.log(test1);
      if(test1 == null || test1[0] !== 'AdminBoard')
      {
        next({name: 'Nonauthorised'});
      }else{
        if(to.meta.auth){
          next();
        }else{
          next({name: 'Nonauthorised'});
        }
      }
      break;

  } 
};
