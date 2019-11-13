import { Component } from '@angular/core';
import { DataService } from './data.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'myfirstapp';
  users = ['Erick','Nailet','Ronald','Naiyerith','Ari'];

  activated:boolean = false;
  name:string = 'Erick Ramirez';
  age:number = 28;
  adress:{
    street:string;
    city:string;
  }
  hobbies:string[];

  constructor(private dateService:DataService) {
    this.age=28;
    this.adress = {
      street:'2218 Baker Street',
      city:'London'
    }
    this.hobbies = ['swinnig','read','write'];

    this.dateService.getData
  }

  sayHello(){
    alert("Hello...");
  }

  addUser(newUser){
    this.users.push(newUser.value)
    newUser.value="";
    newUser.focus();
    return false;
  }

  daleteUser(user){
    for(let i=0;i<this.users.length;i++){
      if (user==this.users[i]){
        this.users.splice(i,1);
      }
    }
  }

  posts = [];
}
