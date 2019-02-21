export enum BottomPanelCommandType {
  Error,
  Load,
  Clear
}

export class BottomPanelCommand {
  type: BottomPanelCommandType;
  data?: string;
}
