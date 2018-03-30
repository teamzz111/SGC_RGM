import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { HttpModule } from '@angular/http';

@Injectable()
export class UserServiceService {
  constructor(private http: Http) {}
  listar() {
    return this.http.get(
      'http://localhost/SGC_RGM/gui/gui/dist/assets/img/php/test.php?srv=1'
    );
  }
}
