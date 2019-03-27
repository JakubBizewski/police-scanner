import { Citizen } from './citizen';

export class Offense {
  id: number;
  name: string;
  fine: number;
  isFelony: boolean;
}

export class Citation {
  id: number;
  citizen: Citizen;
  offense: Offense;
  issueTime: Date;
  description: string;
  status: string;
}
