import { Citizen } from './citizen';

export class Vehicle {
  id: number;
  model: VehicleModel;
  vin: string;
  colour: string;
  productionYear: Date;
}

export class VehicleRegistration {
  id: number;
  vehicle: Vehicle;
  owner: Citizen;
  number: string;
  createTime: Date;
  expireTime: Date;
}

export class VehicleInsurance {
  id: number;
  vehicle: Vehicle;
  owner: Citizen;
  createTime: Date;
  expireTime: Date;
}

export class VehicleBrand {
  id: number;
  name: string;
}

export class VehicleModel {
  id: number;
  name: string;
  brand: VehicleBrand;
  mass: number;
  power: number;
  torque: number;
}
