// add user modules here
const { postAjax } = require('./ajax');

const handleSubmitLogin = (evt) => {
  evt.preventDefault();
  const formElements = Array.from(evt.target.elements);
  postAjax('/', 'login', formElements) 
    .then((res) => res);
};

const loginInit = () => {
  const $loginContainer = document.querySelector('.login_container');
  if (!$loginContainer){
    return;
  }
  const $form = document.querySelector('form#login');
  $form.addEventListener('submit', handleSubmitLogin);
};

loginInit();
