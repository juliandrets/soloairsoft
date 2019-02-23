import React, { Component } from 'react';
import logo from './img/logo.png';

class App extends Component {
  render() {
    return (
      <div className="App">
        <header>
          <section className="content">
            <a href="/"><img src={logo} className="logo" alt="logo" /></a>
            <form id="search" action="/items" method="GET">
              <input type="text" name="search" placeholder="Nunca dejes de buscar"/>
              <button type="submit"><i class="fab fa-searchengin"></i></button>
            </form>
            <ul className="header-data">
              <li><i class="far fa-bell"></i></li>
              <li><i class="far fa-heart"></i></li>
              <li className="user-name">Julian <figure></figure></li>
            </ul>
          </section>
        </header>
      </div>
    );
  }
}

export default App;
