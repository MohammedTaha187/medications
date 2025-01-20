
  
  window.onload = function() {
    const elements = document.querySelectorAll('.fade-effect');
    
    elements.forEach((element, index) => {
      
      setTimeout(() => {
        element.classList.add('show'); 
      }, index * 300); 
    });
  }


  window.onload = function() {
    const elements = document.querySelectorAll('.fade-effect');
    
    elements.forEach((element, index) => {
      setTimeout(() => {
        element.classList.add('show'); 
      }, index * 300); 
    });
  }


  
  function createBubble() {
    const bubble = document.createElement('div');
    bubble.classList.add('bubble');
    
    
    const size = Math.random() * (50 - 20) + 20; 
    bubble.style.width = `${size}px`;
    bubble.style.height = `${size}px`;

    
    const leftPosition = Math.random() * window.innerWidth; 
    bubble.style.left = `${leftPosition}px`;

    
    const duration = Math.random() * 3 + 5; 
    bubble.style.animationDuration = `${duration}s`;

    
    document.body.appendChild(bubble);

    
    setTimeout(() => {
      bubble.remove();
    }, duration * 1000); 
  }

  
  setInterval(createBubble, 500); 



