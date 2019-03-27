import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LandingComponent } from './landing/landing.component';
import { SearchComponent } from './search/search.component';
import { ReactiveFormsModule } from '@angular/forms';
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
  MatFormFieldModule,
  MatDatepickerModule,
  MatSelectModule,
  MatDialogModule,
} from '@angular/material';
import { BottomPanelComponent } from './bottom-panel/bottom-panel.component';
import { MatMomentDateModule } from '@angular/material-moment-adapter';
import { CitizenPanelComponent } from './citizen-panel/citizen-panel.component';
import { CitationsComponent } from './citizen-panel/citations/citations.component';
import { CitationComponent } from './citizen-panel/citations/citation/citation.component';
import { CitationAddDialogComponent } from './citizen-panel/citations/citation-add-dialog/citation-add-dialog.component';

@NgModule({
  declarations: [
    AppComponent,
    LandingComponent,
    SearchComponent,
    BottomPanelComponent,
    CitizenPanelComponent,
    CitationsComponent,
    CitationComponent,
    CitationAddDialogComponent
  ],
  imports: [
    ReactiveFormsModule,
    BrowserModule,
    BrowserAnimationsModule,
    HttpClientModule,
    AppRoutingModule,
    MatMomentDateModule,
    MatInputModule,
    MatFormFieldModule,
    MatDatepickerModule,
    MatSelectModule,
    MatSlideToggleModule,
    MatButtonModule,
    MatProgressSpinnerModule,
    MatCardModule,
    MatSnackBarModule,
    MatIconModule,
    MatMenuModule,
    MatDialogModule
  ],
  providers: [],
  bootstrap: [AppComponent],
  entryComponents: [
    CitationAddDialogComponent
  ]
})
export class AppModule { }
