import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LandingComponent } from './landing/landing.component';
import { VehicleSearchComponent } from './vehicle-search/vehicle-search.component';
import { CitizenSearchComponent } from './citizen-search/citizen-search.component';

const routes: Routes = [
    { path: '', component: LandingComponent },
    { path: 'vehicle-search', component: VehicleSearchComponent },
    { path: 'citizen-search', component: CitizenSearchComponent }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
