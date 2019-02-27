import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LandingComponent } from './landing/landing.component';
import { SearchComponent } from './search/search.component';
import { CitizenPanelComponent } from './citizen-panel/citizen-panel.component';

const routes: Routes = [
    { path: '', component: LandingComponent },
    { path: 'search', component: SearchComponent },
    { path: 'citizen/:id', component: CitizenPanelComponent }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
