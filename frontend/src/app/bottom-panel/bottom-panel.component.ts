import { Component, OnInit } from '@angular/core';
import { BottomPanelService } from './bottom-panel.service';
import { BottomPanelCommand, BottomPanelCommandType } from './bottom-panel-command';

@Component({
  selector: 'app-bottom-panel',
  templateUrl: './bottom-panel.component.html',
  styleUrls: ['./bottom-panel.component.scss']
})
export class BottomPanelComponent implements OnInit {
  constructor(private service: BottomPanelService) { }

  error: string;
  loading: boolean;

  private handleCommand(command: BottomPanelCommand) {
    switch (command.type) {
      case BottomPanelCommandType.Error:
        this.error = command.data;
        this.loading = false;
        break;
      case BottomPanelCommandType.Load:
        this.error = null;
        this.loading = true;
        break;
      case BottomPanelCommandType.Clear:
        this.error = null;
        this.loading = null;
        break;
    }
  }

  ngOnInit() {
    this.service.command.subscribe(command => this.handleCommand(command));
  }
}
