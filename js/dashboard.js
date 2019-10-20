const buildMembersOfCategory = (category, quantity) => {
  const $level1Wrapper = document.querySelector('.level1_wrapper'); 
  $level1Wrapper.classList.add('hide');

  const $level2Wrapper = document.createElement('div'); 
  $level2Wrapper.classList.add('level2_wrapper');
  
  const $level2Category = document.createElement('div'); 
  $level2Category.classList.add('level2_category');
  const $cat2Back = document.createElement('img'); 
  const $cat2Name = document.createElement('span'); 
  const $cat2Quantity = document.createElement('span'); 

  $cat2Back.src = '/images/chevron.png';
  $cat2Back.alt = 'back arrow';
  
  $cat2Name.innerText = category;
  $cat2Name.quantity = quantity;

  $level2Category.append($cat2Back, $cat2Name, $cat2Quantity);
  const $dashboardContainer = document.querySelector('.dashboard_container');
  $dashboardContainer.append($level2Category);

  const $requests = document.querySelector('#requests');
  const requests = JSON.parse($requests.innerHTML); 
  
  const specificUsers = requests.filter((request) => request.category_name === category);
  console.log(specificUsers);

  specificUsers.forEach((user) => {
    const $li = document.createElement('li');
    const $name = document.createElement('div');
    const $email = document.createElement('div');
    const $div = document.createElement('div');
    const $anchor = document.createElement('a');

    $anchor.href = '#';
    $anchor.dataset.category = category.replace(' ', '_');
    $anchor.addEventListener('click', handleClickCategory);
    $div.classList.add('column_container');

    

  });
 
};

const handleClickCategory = (evt) => {
  evt.preventDefault();
  const $closestAnchor = evt.target.closest('a'); 
  const category = $closestAnchor.dataset.category.replace('_', ' ');
  const quantity = $closestAnchor.dataset.quantity.replace('_', ' ');

  buildMembersOfCategory(category, quantity);
};

const buildSubCategories = (uniqueCategories, requests) => {
  const $ul = document.createElement('ul');

  uniqueCategories.forEach((category) => { 
    const $li = document.createElement('li');
    const $spanName = document.createElement('span');
    const $spanQuantity = document.createElement('span');
    const $div = document.createElement('div');
    const $anchor = document.createElement('a');

    $anchor.href = '#';
    $anchor.dataset.category = category.replace(' ', '_');
    $anchor.addEventListener('click', handleClickCategory);
    $div.classList.add('row_container');

    const quantity = requests.filter((request) => request.category_name === category).length;

    $anchor.dataset.quantity = quantity;
  
    $spanName.innerText = category;
    $spanQuantity.innerText = quantity;

    $div.append($spanName, $spanQuantity);  
    $anchor.append($div);
    $li.append($anchor);
    $ul.append($li);
  });
 
  const $dashboardContainer = document.querySelector('.dashboard_container'); 
  const $pendingRequestsContainer = document.querySelector('.pending_requests_container'); 
  const $level1Wrapper = document.createElement('div');
  $level1Wrapper.classList.add('level1_wrapper');

  $level1Wrapper.append($pendingRequestsContainer, $ul);
  $dashboardContainer.append($level1Wrapper);
  

  //$dashboardContainer.append($ul);

};

const buildDashboard = () => {
  const $requests = document.querySelector('#requests');
  const requests = JSON.parse($requests.innerHTML); 
  const pendingRequests = requests.length;
  const $pendingRequestsCount = document.querySelector('.pending_requests_container .quantity');  
  $pendingRequestsCount.innerHTML = pendingRequests;

  const uniqueCategories = Array.from(new Set(requests.map((request) => request.category_name)));
  buildSubCategories(uniqueCategories, requests);
};

const dashboardInit = () => {
  const $dashboardContainer = document.querySelector('.dashboard_container');
  if (!$dashboardContainer){
    return;
  }
  buildDashboard();
};

dashboardInit();
