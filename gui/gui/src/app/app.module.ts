import { UserServiceService } from './user-service.service';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { Desktop1Component } from './desktop1/desktop1.component';
import { Desktop2Component } from './desktop2/desktop2.component';
import { Desktop3Component } from './desktop3/desktop3.component';
import { SearchuserComponent } from './desktop3/searchuser/searchuser.component';
import { InsertuserComponent } from './desktop3/insertuser/insertuser.component';
import { UpdateuserComponent } from './desktop3/updateuser/updateuser.component';


@NgModule({
  declarations: [
    AppComponent,
    Desktop1Component,
    Desktop2Component,
    Desktop3Component,
    SearchuserComponent,
    InsertuserComponent,
    UpdateuserComponent
  ],
  imports: [
    BrowserModule, HttpModule
  ],
  providers: [UserServiceService],
  bootstrap: [AppComponent]
})

export class AppModule { }
