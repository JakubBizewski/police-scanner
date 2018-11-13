export class VehicleModel {
  id: number;
  modelId: number;
  vin: string;
  colour: string;
  productionYear: Date;
}

export class VehicleRegistrationModel {
  id: number;
  vehicleId: number;
  ownerId: number;
  number: string;
  createTime: Date;
  expiretime: Date;
}

export class VehicleBrandModel {
  id: number;
  name: string;
}

export class VehicleModelModel {
  id: number;
  name: string;
  brandId: number;
  mass: number;
  power: number;
  torque: number;
}
