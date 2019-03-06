import { Citizen } from './citizen';

export class Visa {
  id: number;
  owner: Citizen;
  createTime: Date;
  expireTime: Date;
}
