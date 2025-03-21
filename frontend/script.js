// Add interactivity (e.g., testimonial slider, form submission)
document.addEventListener('DOMContentLoaded', function () {
    // Example: Testimonial Slider
    const testimonials = document.querySelectorAll('.testimonial');
    let currentTestimonial = 0;
  
    function showTestimonial(index) {
      testimonials.forEach((testimonial, i) => {
        testimonial.style.display = i === index ? 'block' : 'none';
      });
    }
  
    setInterval(() => {
      currentTestimonial = (currentTestimonial + 1) % testimonials.length;
      showTestimonial(currentTestimonial);
    }, 5000);
  
    showTestimonial(currentTestimonial);
  });