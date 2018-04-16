import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import { HttpModule } from '@angular/http';
import 'rxjs/add/operator/map';
@Injectable()
export class UserServiceService {
  data;
  constructor(private http: Http) {}
  listar(opt) {
    if ( opt === 1) {
    return this.http.get(
      'http://localhost/sgc/gui/php/test.php?srv=1');
    } else {
          return this.http.get(
      'http://localhost/sgc/gui/php/test.php?srv=4');
    }
    }
  closeSession() {
    return this.http.get('http://localhost/sgc/gui/php/test.php?srv=2');
  }

  verify() {
    return this.http.get('http://localhost/sgc/gui/php/test.php?srv=3');
  }

  buscar(n, string) {
    if ( n === 0 ) {
      return this.http.get('http://localhost/sgc/gui/php/options.php?srv=5&opt1=' + string.substring(0 , 1) +
       '&opt2=' + string.substring(1 , 2) + '&opt3=' + string.substring(2 , 3) + '&opt4=' + string.substring(3 , 4) );
    }
  }

}
