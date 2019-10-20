const postAjax = (url, action, form) => {
  const formData = new FormData();
  formData.append('ajax', 1);
  formData.append('action', action);

  const formElements = form.map(($element) => {
    if (!$element.name) return '';
    return { [$element.name]: $element.value };
  }).filter((x) => x);

  formElements.forEach(($obj) => {
    const [key, val] = Object.entries($obj)[0];
    formData.append(key, val);
  });

  return fetch(url, {
    method: 'POST',
    body: formData,
  });
};

module.exports = {
  postAjax,
};
