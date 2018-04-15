import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { HttpModule } from '@angular/http';
@Injectable()
export class UserServiceService {
  constructor(private http: Http) {}
  listar() {
    return this.http.get(
      'http://localhost/sgc/gui/php/test.php?srv=1');
  }
  closeSession() {
    return this.http.get('http://localhost/sgc/gui/php/test.php?srv=2');
  }

  verify() {
    return this.http.get('http://localhost/sgc/gui/php/test.php?srv=3');
  }
}
