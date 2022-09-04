var post=document.getElementById("floatingTextarea");

post.addEventListener("keypress",()=>{
    //var text=post.value.trim();
    document.getElementById("title").innerText=post.value.length;
   
});