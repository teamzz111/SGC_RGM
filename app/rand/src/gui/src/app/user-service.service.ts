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
    this.url = 'http://andreslargo.com/sgc/gui/gui/php/';
  }
  obtenerPermisos() {
    return this.http.get(this.url + 'test.php?srv=8');
  }
  registrar(opt) {
    return this.http.get(this.url + 'register.php?opt=' + opt);
  }
  listar(opt) {
    if ( opt === 1) {
    return this.http.get(this.url + 'test.php?srv=1');
    } else {
          return this.http.get(this.url + 'test.php?srv=4&opt1=10&opt2=0&opt3=0&opt4=0&cc=0');
    }
  }
  closeSession() {
    return this.http.get(this.url + 'test.php?srv=2');
  }

  verify() {
    return this.http.get(this.url + 'test.php?srv=3');
  }

  buscar(n, string) {
    if ( n === 0 ) {
      return this.http.get(this.url + 'test.php?srv=7&opt1=' + string.substring(0 , 1) +
       '&opt2=' + string.substring(1 , 2) + '&opt3=' + string.substring(2 , 3) + '&opt4=' + string.substring(3 , 4));
      } else {
      return this.http.get(this.url + 'test.php?srv=7&opt1=10&opt2=0&opt3=0&opt4=0&cc=' + string);
    }
  }
  insertar(data) {
     return this.http.post(this.url + 'register.php', JSON.stringify(data));
  }

  busca(data) {
    return this.http.get(this.url + 'updateuser.php?opt=1&cc=' + data);
  }
  actualiza(data) {
    return this.http.post(this.url + 'updateuser.php?opt=2', JSON.stringify(data));
  }
  bloquear(n, data) {
    if (n === 1) {
      return this.http.get(this.url + 'lockuser.php?opt=1&cc=' + data);
    } else if (n === 2) {
      return this.http.get(this.url + 'lockuser.php?opt=2&cc=' + data);
    } else {
      return this.http.get(this.url + 'lockuser.php?opt=3&cc=' + data);
    }
  }
  insertarjob(data) {
    return this.http.post(this.url + 'AddCargo.php', JSON.stringify(data));
  }

  guardarEncuesta(data) {
    return this.http.post(this.url + 'AddPoll.php?opt=1', data);
  }

  guardarPregunta(data) {
    return this.http.post(this.url + 'AddPoll.php?opt=2', data);
  }
}