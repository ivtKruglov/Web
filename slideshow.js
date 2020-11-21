let slides = document.getElementById('slides');
let slideshow = document.getElementById('slideshow-container');
let prev = document.getElementById('left');
let next = document.getElementById('right');
let cont = document.getElementById('content');
let listitems = slides.querySelectorAll('div');
let width = slides.getBoundingClientRect().width;
let elwidth = listitems[0].getBoundingClientRect().width;
let elmargin = parseInt(window.getComputedStyle(listitems[0]).getPropertyValue("margin-left"));
let position = 0;
let end_pos = 0;
let step = elwidth + elmargin*2;
let index = 0;

if (cont.clientWidth % (elwidth + elmargin*2) != 0)
{
  let newwidth = cont.clientWidth - cont.clientWidth % (elwidth + elmargin*2);
  slideshow.style.width = newwidth + 'px';
}

window.addEventListener("resize", function()
{
  if (cont.clientWidth % (elwidth + elmargin*2) != 0)
  {
    let newwidth = cont.clientWidth - cont.clientWidth % (elwidth + elmargin*2);
    slideshow.style.width = newwidth + 'px';
  }
});

prev.addEventListener("click", function()
  {
    if (index > 0)
    {
      let time = setInterval(frame, 1);
      end_pos = position + step;
      function frame()
      {
        if (position == end_pos)
        {
          clearInterval(time);
          prev.disabled = false;
        }
        else
        {
          position += 1;
          slides.style.marginLeft = position + 'px';
        }
      }
      index -= 1;
    }
  });

next.addEventListener("click", function()
  {
    if (index < listitems.length-8)
    {
      let time = setInterval(frame, 1);
      end_pos = position - step;
      function frame()
      {
        if (position == end_pos)
        {
          clearInterval(time);
          next.disabled = false;
        }
        else
        {
          position -= 1;
          slides.style.marginLeft = position + 'px';
        }
      }
      index += 1;
    }
  });