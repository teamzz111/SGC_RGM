import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { HttpModule } from '@angular/http';

@Injectable()
export class UserServiceService {
  constructor(private http: Http) {}
  listar() {
    return this.http.get(
      'http://localhost:81/SGC_RGM/gui/gui/dist/assets/img/php/test.php?srv=1'
    );
  }
  closeSession() {
    return this.http.get('ttp://localhost:81/SGC_RGM/gui/gui/dist/assets/img/php/test.php?srv=2');
  }
}
