import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LandingComponent } from './landing/landing.component';
import { VehicleSearchComponent } from './vehicle-search/vehicle-search.component';
import { CitizenSearchComponent } from './citizen-search/citizen-search.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {
  MatButtonModule,
  MatCardModule,
  MatInputModule,
  MatProgressSpinnerModule,
  MatSlideToggleModule,
  MatSnackBarModule,
  MatIconModule,
  MatMenuModule,
} from '@angular/material';
import { RegistrationCardComponent } from './vehicle-search/registration-card/registration-card.component';
import { InsuranceCardComponent } from './vehicle-search/insurance-card/insurance-card.component';
import { CitizenOverviewComponent } from './citizen-overview/citizen-overview.component';

@NgModule({
  declarations: [
    AppComponent,
    LandingComponent,
    VehicleSearchComponent,
    CitizenSearchComponent,
    RegistrationCardComponent,
    InsuranceCardComponent,
    CitizenOverviewComponent
  ],
  imports: [
    FormsModule,
    ReactiveFormsModule,
    BrowserModule,
    BrowserAnimationsModule,
    HttpClientModule,
    AppRoutingModule,
    MatInputModule,
    MatSlideToggleModule,
    MatButtonModule,
    MatProgressSpinnerModule,
    MatCardModule,
    MatSnackBarModule,
    MatIconModule,
    MatMenuModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
