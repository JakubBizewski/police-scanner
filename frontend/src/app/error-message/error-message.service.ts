import { EventEmitter, Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ErrorMessageService {
  constructor() { }

  private errorEmitter = new EventEmitter<string>();

  public get errors() {
    return this.errorEmitter;
  }

  public addError(message: string) {
    this.errorEmitter.emit(message);
  }

  public clear() {
    this.errorEmitter.emit(null);
  }
}
