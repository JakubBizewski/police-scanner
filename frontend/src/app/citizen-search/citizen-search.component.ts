import { Component, OnInit } from '@angular/core';
import { Citizen } from '../entity/citizen';
import { CitizenService } from '../citizen.service';
import { HttpErrorResponse } from '@angular/common/http';
import { MatSnackBar } from '@angular/material';
import { FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-citizen-search',
  templateUrl: './citizen-search.component.html',
  styleUrls: ['./citizen-search.component.scss']
})
export class CitizenSearchComponent implements OnInit {
  constructor(private citizenService: CitizenService, private snackBar: MatSnackBar) { }

  citizen: Citizen;
  searching: boolean;
  fullName = new FormControl('', [
    Validators.pattern('^[A-z]+ [A-z]+$'),
    Validators.required
  ]);

  search() {
    this.searching = true;
    this.citizen = null;

    this.citizenService.getCitizenByFullName(this.fullName.value)
      .subscribe(
        citizen => {
          this.citizen = citizen;
          this.searching = false;
        },
      (error: HttpErrorResponse) => {
        if (error.status === 404) {
          this.showErrorSnackBar('Citizen not found!');
        } else {
          this.showErrorSnackBar('Something went wrong!');
        }

        this.searching = false;
      }
    );
  }

  showErrorSnackBar(message: string) {
    this.snackBar.open(message, 'OK', {
      duration: 3000
    });
  }

  ngOnInit() {
  }
}
