import React from 'react';
import ReactDOM from 'react-dom';

function App(){
  return(
    <h5>Hello WebPack!!</h5>
  );
} 

const element = document.getElementById('react');
ReactDOM.render(<App/>,element);
