import { Component, Input, OnInit } from '@angular/core';
import { Citation } from '../../entity/citation';
import { Citizen } from '../../entity/citizen';
import { CitationService } from '../../citation.service';
import { MatDialog } from '@angular/material';
import { CitationAddDialogComponent } from './citation-add-dialog/citation-add-dialog.component';

@Component({
  selector: 'app-citations',
  templateUrl: './citations.component.html',
  styleUrls: ['./citations.component.scss']
})
export class CitationsComponent implements OnInit {
  constructor(private citationService: CitationService, private dialog: MatDialog) { }

  @Input()
  citizen: Citizen;

  citations: Citation[];

  showAddDialog() {
    const dialog = this.dialog.open(CitationAddDialogComponent, {
      maxWidth: '900px',
      data: { citizen: this.citizen }
    });

    dialog.afterClosed().subscribe(() => this.getCitations());
  }

  getCitations() {
    this.citationService.getCitationsForCitizen(this.citizen.id)
      .subscribe(citations => this.citations = citations);
  }

  ngOnInit() {
    this.getCitations();
  }
}
