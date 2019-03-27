import { Component, Input, OnInit } from '@angular/core';
import { Citation } from '../../../entity/citation';

@Component({
  selector: 'app-citation',
  templateUrl: './citation.component.html',
  styleUrls: ['./citation.component.scss']
})
export class CitationComponent implements OnInit {
  constructor() { }

  @Input()
  citation: Citation;

  expanded = false;

  ngOnInit() {
  }
}
