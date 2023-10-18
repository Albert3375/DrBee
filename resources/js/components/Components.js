import React from 'react';
import ReactDOM from 'react-dom';

import AddCard from './AddCard';

if (document.getElementById("add-card-form")) {
  const form = document.getElementById('add-card-form')
    console.log(form)
  const user_id = form.getAttribute('user_id');

  ReactDOM.render(
      <AddCard user_id={user_id}/>,
      document.getElementById("add-card-form")
  );
}
