import { Controller } from "@hotwired/stimulus";

import axios from "axios";

export default class extends Controller {
  static values = {
    infoUrl: String,
  };
  connect() {
    console.log("I just appeared into existence!");
  }
  play(event) {
    event.preventDefault();
    // console.log(this.infoUrlValue);

    axios.get(this.infoUrlValue).then((response) => {
      // console.log(response);
      const audio = new Audio(response.data.url);
      audio.play();
    });
  }
}
