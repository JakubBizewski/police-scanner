import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LandingComponent } from './landing/landing.component';
import { VehicleSearchComponent } from './vehicle-search/vehicle-search.component';
import { CitizenSearchComponent } from './citizen-search/citizen-search.component';
import {
  MzButtonModule,
  MzInputModule,
  MzNavbarModule,
  MzSwitchModule,
} from 'ngx-materialize'

@NgModule({
  declarations: [
    AppComponent,
    LandingComponent,
    VehicleSearchComponent,
    CitizenSearchComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    MzNavbarModule,
    MzInputModule,
    MzSwitchModule,
    MzButtonModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
