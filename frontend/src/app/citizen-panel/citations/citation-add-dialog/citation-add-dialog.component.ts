import { Component, Inject, OnInit } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { OffenseService } from '../../../offense.service';
import { Offense } from '../../../entity/citation';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { CitationService } from '../../../citation.service';
import { CitationModel } from '../../../models/citation';
import * as moment from 'moment';

@Component({
  selector: 'app-citation-add-dialog',
  templateUrl: './citation-add-dialog.component.html',
  styleUrls: ['./citation-add-dialog.component.scss']
})
export class CitationAddDialogComponent implements OnInit {
  constructor(
    public dialogRef: MatDialogRef<CitationAddDialogComponent>,
    private offenseService: OffenseService,
    private citationService: CitationService,
    @Inject(MAT_DIALOG_DATA) public data: MAT_DIALOG_DATA
  ) {}

  createForm = new FormGroup({
    offense: new FormControl('', Validators.required),
    status: new FormControl('', [
      Validators.required,
      Validators.maxLength(20)]),
    description: new FormControl('', Validators.required)
  });

  offenses: Offense[];

  createCitation() {
    const model: CitationModel = {
      citizenId: this.data.citizen.id,
      offenseId: this.createForm.controls['offense'].value,
      description: this.createForm.controls['description'].value,
      status: this.createForm.controls['status'].value,
      issueTime: moment().format()
    };

    this.citationService.createCitation(model).subscribe(() => this.closeDialog());
  }

  closeDialog() {
    this.dialogRef.close();
  }

  ngOnInit() {
    this.offenseService.getAllOffenses().subscribe(
      offences => this.offenses = offences
    );
  }
}
