<?php

	namespace DbDoctrine\Entity;
	
	use Doctrine\ORM\Mapping as ORM;
	/*use ZfcUser\Entity\UserInterface;
	use BjyAuthorize\Provider\Role\ProviderInterface;*/
	use Doctrine\Common\Collections\ArrayCollection;


	/**
	* @ORM\Entity
	* @ORM\Table(name="don_vi_tinh")
	*/
	class DonViTinh {
		
		/**
		* @ORM\Column(name="id_don_vi_tinh",type="integer")
		* @ORM\Id
		* @ORM\GeneratedValue
		*/
		private $idDonViTinh;


		/**
		* @ORM\Column(name="ten_don_vi_tinh")
		*/
		private $tenDonViTinh;


		public function setIdDonViTinh($idDonViTinh)
		{
			$this->idDonViTinh=$idDonViTinh;
		}
		public function getIdDonViTinh()
		{
			return $this->idDonViTinh;
		}


		public function setTenDonViTinh($tenDonViTinh)
		{
			$this->tenDonViTinh=$tenDonViTinh;
		}
		public function getTenDonViTinh()
		{
			return $this->tenDonViTinh;
		}
	}
?>