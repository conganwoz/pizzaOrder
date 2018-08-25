var Imgs = $('.postImg').get();
var currentImg = 0;
console.log(Imgs);
function clear(){
  Imgs.forEach((item)=>{
    item.style.display = 'none';
    $('.dot').css('background-color','#bbb');
  });
}
function start(){
  Imgs[0].style.display = 'block';
  $('#dot0').css('background-color','#e43838');
}
clear();
start();

$('#arrow_left').click(()=>{
  currentImg--;
  if(currentImg <= -1){
    currentImg = Imgs.length - 1;
  }
  clear();
  $(`#img${currentImg}`).fadeIn('slow');
  $(`#dot${currentImg}`).css('background-color','#e43838');
});

$('#arrow_right').click(()=>{
  currentImg++;
  if(currentImg >= Imgs.length){
    currentImg = 0;
  }
  clear();
  $(`#img${currentImg}`).fadeIn('slow');
  $(`#dot${currentImg}`).css('background-color','#e43838');
});


setInterval(()=>{
  currentImg++;
  if(currentImg >= Imgs.length){
    currentImg = 0;
  }
  clear();
  //Imgs[currentImg].style.display = 'block';
  //Imgs[currentImg].fadeIn(slow);
  $(`#img${currentImg}`).fadeIn(1000);
  $(`#dot${currentImg}`).css('background-color','#e43838');
},4000);
