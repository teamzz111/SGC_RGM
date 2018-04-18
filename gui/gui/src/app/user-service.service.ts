import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import { HttpModule } from '@angular/http';
import 'rxjs/add/operator/map';
@Injectable()
export class UserServiceService {
  data;
  url: string;
  constructor(private http: Http) {
     this.url = 'localhost';
  }
  registrar(opt) {
    return this.http.get('../../php/register.php?opt=' + opt);
  }
  listar(opt) {
    if ( opt === 1) {
    return this.http.get(
      '../../php/test.php?srv=1');
    } else {
          return this.http.get('../../php/test.php?srv=4');
    }
  }
  closeSession() {
    return this.http.get('../../php/test.php?srv=2');
  }

  verify() {
    return this.http.get('../../php/test.php?srv=3');
  }

  buscar(n, string) {
    if ( n === 0 ) {
      return this.http.get('../../php/options.php?srv=5&opt1=' + string.substring(0 , 1) +
       '&opt2=' + string.substring(1 , 2) + '&opt3=' + string.substring(2 , 3) + '&opt4=' + string.substring(3 , 4) );
    } else {
      return this.http.get('../../php/options.php?srv=5&opt1=10&opt2=0&opt3=0&opt4=0&cc=' + string);
    }
  }

}
