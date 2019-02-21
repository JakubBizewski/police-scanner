import { EventEmitter, Injectable } from '@angular/core';
import { BottomPanelCommand, BottomPanelCommandType } from './bottom-panel-command';

@Injectable({
  providedIn: 'root'
})
export class BottomPanelService {
  constructor() { }

  private commandEmitter = new EventEmitter<BottomPanelCommand>();

  public get command() {
    return this.commandEmitter;
  }

  public showError(message: string) {
    this.commandEmitter.emit({
      type: BottomPanelCommandType.Error,
      data: message
    });
  }

  public showLoader() {
    this.commandEmitter.emit({
      type: BottomPanelCommandType.Load
    });
  }

  public clear() {
    this.commandEmitter.emit({
      type: BottomPanelCommandType.Clear
    });
  }
}
