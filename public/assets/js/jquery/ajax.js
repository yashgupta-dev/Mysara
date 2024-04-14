/**
* PHP Email Form Validation - v3.6
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  toastr.options = {
    "closeButton": true,
    "debug": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": 'toast-bottom-right',
    "preventDuplicates": false,
    "showDuration": 300,
    "hideDuration": 1000,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  let forms = document.querySelectorAll('.form-ajax');
  
  forms.forEach(function (e) {

    e.addEventListener('submit', function (event) {
      event.preventDefault();

      
      let thisForm = this;
      let btnText = 'Submit';
      
      removeErrorDivs(thisForm); // remove errors;

      let action = thisForm.getAttribute('action');
      let method = thisForm.getAttribute('method');
      // let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');

      if (!action) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }
      
      thisForm.button.setAttribute('disabled','disabled');
      btnText = thisForm.button.innerHTML;
      thisForm.button.innerHTML = 'wait..';
      // thisForm.querySelector('.error-message').classList.remove('d-block');
      // thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData(thisForm);

      formData.append('is_ajax', '1'); // Append the is_ajax field with the value '1'
      
      call(thisForm, action, method, formData, btnText);
    });
  });

  function call(thisForm, action, method, formData, btnText) {

    fetch(action, {
      method: method,
      body: formData,
      // headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
      .then(response => {

        if (response.ok) {
          return response.text();
        } else {
          throw new Error(`${response.status} ${response.statusText} ${response.url}`);
        }
      })
      .then(data => {
        thisForm.button.removeAttribute('disabled');
        thisForm.button.innerHTML = btnText;
        // thisForm.querySelector('.loading').classList.remove('d-block');

        var res = JSON.parse(data);
        
        if (res.errors) {
          errorCreate(res.errors,thisForm);
        }       

        if(res.success) {
          // thisForm.querySelector('.sent-message').innerHTML = res.message;
          // thisForm.querySelector('.sent-message').classList.add('d-block');
          thisForm.reset(); 
          toastr.success('Success',res.message);
        }

        
        if(res.redirect_url) {
          window.location.href = res.redirect_url;
        }
        
      })
      .catch((error) => {
        displayError(thisForm, error, btnText);
      });
  }

  function displayError(thisForm, error, btnText) {
    toastr.error('Error',error);
    thisForm.button.removeAttribute('disabled');
    thisForm.button.innerHTML = btnText;

    // thisForm.querySelector('.loading').classList.remove('d-block');
    // thisForm.querySelector('.error-message').innerHTML = error;
    // thisForm.querySelector('.error-message').classList.add('d-block');
  }

  function errorCreate(errors, formData) {
    if(errors.length == undefined) {
      $.each(errors, function (i, v) {
        var errorText = `<div class="text-danger" id="errors" style="font-size:12px;"><small>${v}</small></div>`;
        
        var id = `#${i}`;
        toastr.error('Error',v);
        if ($(formData).find(id).length) {
          $(formData).find(id).css({
            'border': '1px solid red'
          });
          $(formData).find(id).parent().append(errorText);
        }

      });
    } else {
      toastr.error('Error',errors);
    }
  }

  function removeErrorDivs(formData) {
    var errorElement = `#errors`;

    var errorElements = formData.querySelectorAll(errorElement);

    errorElements.forEach(function (errorElement) {
      console.log($(errorElement).parent().find('input, select, textarea').css({
        'border': 'none'
      }));
      errorElement.remove();
    });
  }

})();