import { UserServiceService } from './user-service.service';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { FormsModule } from '@angular/forms';
import { AppComponent } from './app.component';
import { Desktop1Component } from './desktop1/desktop1.component';
import { Desktop2Component } from './desktop2/desktop2.component';
import { Desktop3Component } from './desktop3/desktop3.component';
import { SearchuserComponent } from './desktop3/searchuser/searchuser.component';
import { InsertuserComponent } from './desktop3/insertuser/insertuser.component';
import { UpdateuserComponent } from './desktop3/updateuser/updateuser.component';
import { LockuserComponent } from './desktop3/lockuser/lockuser.component';
import { Desktop4Component } from './desktop4/desktop4.component';
import { InsertseccionalComponent } from './desktop4/insertseccional/insertseccional.component';
import { InsertjobComponent } from './desktop4/insertjob/insertjob.component';
import { UserConfigComponent } from './desktop3/user-config/user-config.component';
import { Desktop5Component } from './desktop5/desktop5.component';
import { UserconfigComponent } from './desktop5/userconfig/userconfig.component';
import { InsertpollComponent } from './desktop4/insertpoll/insertpoll.component';
import { PollComponent } from './desktop5/poll/poll.component';
import { SendmessageComponent } from './desktop3/sendmessage/sendmessage.component';


@NgModule({
  declarations: [
    AppComponent,
    Desktop1Component,
    Desktop2Component,
    Desktop3Component,
    SearchuserComponent,
    InsertuserComponent,
    UpdateuserComponent,
    LockuserComponent,
    Desktop4Component,
    InsertseccionalComponent,
    InsertjobComponent,
    UserConfigComponent,
    Desktop5Component,
    UserconfigComponent,
    InsertpollComponent,
    PollComponent,
    SendmessageComponent
  ],
  imports: [BrowserModule, HttpModule, FormsModule],
  providers: [UserServiceService],
  bootstrap: [AppComponent]
})
export class AppModule {}
